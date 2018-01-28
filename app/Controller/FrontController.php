<?php

namespace app\Controller;

use framework\Base\BaseController;
use framework\Component\MySqlConnection;
use framework\Framework;

class FrontController extends BaseController
{
    //TODO: TEMP SOLUTION, had no time to do login
    const TMP_USER = 1;
    private $db;

    public function init()
    {
        $this->setDb(Framework::$application->getMysqlConnection());
    }

    public function indexAction()
    {
        return $this->getView()->render('front/index', ['posts' => $this->getPosts()]);
    }

    public function postAction()
    {
        if (!isset($_GET['id'])) {
            $this->redirect('front/index');
        }

        if (isset($_POST['submit'], $_POST['entity'], $_POST['postId'], $_POST['message']) && $_POST['entity'] === 'comments') {
            $this->getDb()->createCommand('INSERT INTO `comments` (`message`, `postId`, `authorId`) 
                                                VALUES ("' . $_POST['message'] . '", "' . $_POST['postId'] . '", ' . self::TMP_USER . ')')
                ->execute();
            $this->redirect('front/post&id=' . $_POST['postId']);
        }

        $postId = $_GET['id'];
        return $this->getView()->render('front/post', [
            'post' => $this->getPost($postId),
            'comments' => $this->getComments($postId),
        ]);
    }

    public function addPostAction()
    {
        if (isset($_POST['submit'])) {
            $this->getDb()->createCommand('INSERT INTO `posts` (`title`, `text`, `authorId`)
                                               VALUES ("' . $_POST['title'] . '", "' . $_POST['text'] . '", ' . self::TMP_USER . ')')
                ->execute();
            $this->redirect('front/index');
        }

        return $this->getView()->render('front/add-post', []);
    }

    // TODO: NO TIME TO CREATE REPOSITORY! AND MODEL
    public function getPost($id)
    {
        return $this->getDb()->createCommand('SELECT * FROM `posts` WHERE id = :id', ['id' => $id])->get();
    }

    public function getPosts()
    {
        return $this->getDb()->createCommand('SELECT * FROM `posts` ORDER BY id DESC')->getAll();
    }

    /**
     * @return MySqlConnection
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param MySqlConnection $db
     * @return $this
     */
    public function setDb(MySqlConnection $db)
    {
        $this->db = $db;
        return $this;
    }

    public function getComments($id)
    {
        return $this->getDb()->createCommand('SELECT * FROM `comments` WHERE postId = :id ORDER BY id DESC',
            [
                'id' => $id
            ])
            ->getAll();
    }
}