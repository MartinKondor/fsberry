<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FriendRepository")
 */
class Friend
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $friend_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user1_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user2_id;

    /**
     * @ORM\Column(type="string")
     */
    private $status;
    // Can be friends, request ...

    // Non database values
    private $linkToFriend;
    private $friendProfilePic;
    private $friendName;

    public function getFriendId()
    {
        return $this->friend_id;
    }

    public function getUser1Id(): ?int
    {
        return $this->user1_id;
    }

    public function setUser1Id(int $user1_id): self
    {
        $this->user1_id = $user1_id;
        return $this;
    }

    public function getUser2Id(): ?int
    {
        return $this->user2_id;
    }

    public function setUser2Id(int $user2_id): self
    {
        $this->user2_id = $user2_id;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getFriendName(): ?string
    {
        return $this->friendName;
    }

    public function setFriendName(string $friendName): self
    {
        $this->friendName = $friendName;
        return $this;
    }

    public function getLinkToFriend(): string
    {
        return $this->linkToFriend;
    }

    public function setLinkToFriend(string $linkToFriend): self
    {
        $this->linkToFriend = $linkToFriend;
        return $this;
    }

    public function getFriendProfilePic(): ?string
    {
        return $this->friendProfilePic;
    }

    public function setFriendProfilePic(string $friendProfilePic): self
    {
        $this->friendProfilePic = $friendProfilePic;
        return $this;
    }
}
