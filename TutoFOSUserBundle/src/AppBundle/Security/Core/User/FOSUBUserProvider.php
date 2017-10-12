<?php
namespace AppBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();

        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setter_id = $setter.'Id';
        $setter_token = $setter.'AccessToken';
        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }
        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());
        $this->userManager->updateUser($user);
    }
    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        // Si l'utilisateur n'existe pas
        if (null === $user) {

            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';

            // On créait le nouvel utilisateur ici
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());

            // Selon le service que l'on appelle
            switch ($service) {
                case 'facebook':
                    $user->setFacebookID($username);
                    $user->setImgProfile($response->getProfilePicture()['data']['url']);
                    $user->setUsername($response->getFirstName().$response->getLastName().$response->getUsername());
                    break;
                case 'google':
                    $user->setGoogleID($username);
                    $user->setImgProfile($response->getProfilePicture());
                    $user->setUsername($response->getFirstName().$response->getLastName().$response->getUsername());
                    break;
                case 'twitter':
                    $user->setTwitterID($username);
                    $user->setImgProfile($response->getProfilePicture());
                    $user->setUsername($response->getResponse()['screen_name']);
            }

            // On intègre les champs que l'on souhaite
            // Pour le username, on concatène le nom le prénom et l'id
            //$user->setUsername($response->getFirstName().$response->getLastName().$response->getUsername());

            $user->setEmail($response->getEmail());
            $user->setPassword($username);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);

            return $user;
        }
        // Si l'utilsiateur existe, on utilise la méthode parent
        $user = parent::loadUserByOAuthUserResponse($response);
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        // On change le token
        $user->$setter($response->getAccessToken());
        return $user;
    }
}