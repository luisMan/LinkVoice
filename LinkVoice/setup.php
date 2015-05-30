 <html><head><title>Setting up database For LinkedVoice</title></head><body>

<h3>Setting up...</h3>
<?php
 // Example 21-3: setup.php
include_once 'definitions.php';

$object->createTable('member', 
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
             name VARCHAR(100),
             email VARCHAR(100),
             serialCode VARCHAR(100),
             password VARCHAR(100)');

$object->createTable('profile',
	         'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	          user_id VARCHAR(100),
              repudation BIGINT,
              badgename VARCHAR(100),
              numstars INT(11),
              constribution BIGINT,
              badgenam VARCHAR(100)');


$object->createTable('badges',
	        'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	         reputation INT UNSIGNED,
	         badge VARCHAR(100),
	         name VARCHAR(100)');


$object->createTable('upvote',
                'id int(11) AUTO_INCREMENT PRIMARY KEY,
                 post_id int(11),
                 id_upvoting VARCHAR(100)');


$object->createTable('news_post',
	                  'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	                   id_posting VARCHAR(100),
	                   post_title VARCHAR(1000),
	                   post_img VARCHAR(1000),
	                   post_video VARCHAR(1000),
	                   post_text VARCHAR(4096),
	                   post_view INT,
	                   post_language VARCHAR(100),
	                   post_category VARCHAR(100),
	                   post_time BIGINT,
	                   upvote INT(11),
	                   updated INT(2)');
$object->createTable('commenters',
	                  'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	                  user_posting VARCHAR(100),
	                  post_title VARCHAR(400),
	                  post_time BIGINT,
	                  user_comenting VARCHAR(100),
	                  text VARCHAR(4096),
	                  comment_time BIGINT,
	                  updated INT(2)');
$object->createTable('followers',
	                 'id_writter VARCHAR(100),
	                  id_follower VARCHAR(100)');


if(mysqli_fetch_row($object->executeSQL("SELECT * FROM badges ORDER BY id DESC"))==0)
	{$object-> _insertBadges();}

?>
</body>
</html>