<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Reply
 *
 * @ORM\Table(name="reply")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReplyRepository")
 */
class Reply
{
    /**
     * Many Reply have One Comment.
     * @ManyToOne(targetEntity="AppBundle\Entity\Comments", inversedBy="reply")
     * @JoinColumn(name="comment_id", referencedColumnName="id")
     */
    private $comment;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reply", type="string", nullable=true)
     */
    private $reply;

    public function __construct() {
        $this->comment = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    /**
     * Add Replay
     *
     * @param \AppBundle\Entity\Comments $comment
     *
     * @return Reply
     */
    public function addComment(Reply $comment){
        $comment->setReply($this);
        $this->comment[] = $comment;
        return $this;
    }

    /**
     * @return string
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param string $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    }
}

