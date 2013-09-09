<div class="view">
    <?php echo CHtml::image($data->getTwitterImage(), $data->getFullName(), array('class' => 'contact-image')); ?>
    <div class="contact-details">
        <h2 class="contact-title"><?php echo ucwords(CHtml::encode($data->getFullName())); ?></h2>
        <span class="contact-phone"><img src="/images/phone-icon.png" alt="Phone Number" class="contact-icon"/>
            <?php echo CHtml::encode($data->phone); ?>
        </span>
        <span class="contact-twitter">
            <img src="/images/twitter-icon.png" alt="Twitter Info" class="contact-icon"/>
            <a href="http://www.twitter.com/<?php echo $data->twitter; ?>">
                @<?php echo CHtml::encode($data->twitter); ?>
            </a>
            (
                <?php
                $followers = CHtml::encode($data->getFollowers());
                if ($followers == TwitterCache::INVALID_HANDLE)
                {
                    echo "<span class='unknown-twitter'>unknown twitter account</span>";
                }
                else if ($followers === TwitterCache::NEVER_UPDATED)
                {
                    echo "<span class='unknown-twitter'>couldn't retrieve follower count - check back later.</span>";
                }
                else
                {
                    echo number_format($followers) . ' followers';
                }
                ?>
            )
        </span>
    </div>
    <div class="contact-operations-links">
        <?php echo Chtml::link('edit', array("contact/update/$data->id")); ?>
        <?php echo Chtml::link('delete', array("contact/delete/$data->id"), array('confirm' => 'Are you sure?')); ?>
    </div>
    <span class="clear"></span>
</div>