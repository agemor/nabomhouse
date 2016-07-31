### Shortcodes ###
Use **[rating-system-posts]** to show like & dislike for a page, post,bbPress,buddyPress etc (DO NOT USE FOR COMMENTS).

Use **[rating-system-posts-disable-dislike]** to show only the like button for a page, post,bbPress,buddyPress etc (DO NOT USE FOR COMMENTS).

Use **[rating-system-comments]** to show like & dislike for comments (USE ONLY FOR STANDARD WORDPRESS COMMENTS).

Use **[rating-system-comments-disable-dislike]** to show only the like button for commens (USE ONLY FOR STANDARD WORDPRESS COMMENTS).

Use **[rating-system-top-posts]** to display all posts ordered by their likes.
<br><br>
**Shortcode parameters for [rating-system-top-posts]**:

**number** = the number of posts to be dislayed (type a number here)(default 5)

**display_counter** = display the number of likes after the title (type yes or no)(default yes)

**display_content** = display the content for each post (type yes or no)(default no)

**link_to_post** = make the title of the post a link to original post (type yes or no)(default yes)

**category_slugs** = only display posts from certain categories (type categories slugs here)(default empty)

<br>
**Examples**:

Display top 5 posts: **[rating-system-top-posts number="5"]**

Display top 5 posts without link to original post: **[rating-system-top-posts number="5" link_to_post="no"]**

Display top 5 posts from category with slug cats: **[rating-system-top-posts number="5" category_slugs="cats"]**

Display top 10 posts from multiple categories: **[rating-system-top-posts number="10" category_slugs="cats,dogs,planes"]**

Display top 10 posts from multiple categories with content and no counter: **[rating-system-top-posts display_counter="no" display_content="yes" number="10" category_slugs="cats,dogs,planes"]**
<br><br>
### Developers ###

To get the number of likes/dislike you can use
```php
$post_id = 1; //the post id
$likes = get_post_meta($post_id,'vortex_system_likes',true);
$dislikes = get_post_meta($post_id,'vortex_system_dislikes',true);
```
Custom WP_QUERY arguments to oder by likes
<pre>
$args = array (
			'posts_per_page'         => '10',
			'order'                  => 'DESC',
			'orderby'				 => 'meta_value_num',
			'meta_key'				 => 'vortex_system_likes'
		);		
</pre>
