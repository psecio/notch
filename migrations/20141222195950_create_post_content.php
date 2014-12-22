<?php

use Phinx\Migration\AbstractMigration;

class CreatePostContent extends AbstractMigration
{
    private $posts = array(
        array(
            'title' => 'PHP 5.4.36 Released',
            'content' => 'The PHP development team announces the immediate availability of PHP 5.4.36. Two security-related bugs were fixed in this release, including the fix for CVE-2014-8142. All PHP 5.4 users are encouraged to upgrade to this version.

For source downloads of PHP 5.4.36 please visit our <a href="http://php.net/downloads.php">downloads page</a>, Windows binaries can be found on <a href="http://windows.php.net/download">windows.php.net/download/</a>. The list of changes is recorded in the ChangeLog.',
            'author' => 'user1'
        ),
        array(
            'title' => 'Nulla metus metus, Ullamcorper vel',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero.

Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. ',
            'author' => 'user2'
        ),
        array(
            'title' => 'Nam nec ante!',
            'content' => 'Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper.

Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo.',
            'author' => 'user2'
        )
    );

    /**
     * Migrate Up.
     */
    public function up()
    {
        $adapter = $this->getAdapter();
        $pdo = $adapter->getConnection();

        $sql = 'insert into posts (title, content, author, created, updated)'
            .' values (:title, :content, :author, now(), now())';
        $sth = $pdo->prepare($sql);

        foreach ($this->posts as $post) {
            $sth->execute($post);
        }
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $titles = array();
        foreach ($this->posts as $post) {
            $titles[] = $post['title'];
        }

        $sql = 'delete from posts where title in ("'.implode('","', $titles).'")';
        $this->execute($sql);
    }
}