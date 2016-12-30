<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * The encoded password
     *
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @Assert\NotBlank(groups={"Registration"})
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];


    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getRoles() {
      $roles = $this->roles;

      if (!in_array('ROLE_USER', $roles)) {
        $roles[] = 'ROLE_USER';
      }

      return $roles;
    }
    //public function getRoles()
    //{
    //    return ['ROLE_USER'];
    //}

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
      $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPlainPassword() {
      return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword) {
      $this->plainPassword = $plainPassword;
      // forces the object to look "dirty" to Doctrine. Avoids
      // Doctrine *not* saving this entity, if only plainPassword changes
      $this->password = null;
    }


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}