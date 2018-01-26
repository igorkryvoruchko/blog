<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentsRepository")
 */
class Comments
{
    /**
     * Many Comments have One Blog.
     * @ManyToOne(targetEntity="AppBundle\Entity\Blog", inversedBy="comments")
     * @JoinColumn(name="blog_id", referencedColumnName="id")
     */
    private $blog = null;

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
     * @ORM\Column(name="comment", type="string", nullable=true)
     */
    private $comment;

    /**
     * One Comment has Many Reply.
     *
     * @var ArrayCollection $reply
     *
     * @OneToMany(targetEntity="AppBundle\Entity\Reply", mappedBy="comment", cascade = {"all"}, fetch="LAZY")
     */
    private $reply;



    public function __construct() {
        $this->blog = new ArrayCollection();
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
     * @return mixed
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * @param mixed $blog
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;
    }


    /**
     * Add Contact
     *
     * @param \AppBundle\Entity\Blog $blog
     *
     * @return Comments
     */
    public function addBlog(Blog $blog){
        $blog->setComments($this);
        $this->blog[] = $blog;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * @param ArrayCollection $reply
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    }

    public function __toString() {
        return $this->getComment();
    }


}

