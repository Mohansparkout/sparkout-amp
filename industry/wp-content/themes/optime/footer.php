<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Optime
 */
$back_totop_on = optime_get_opt('back_totop_on', true);
?>
	</div><!-- #content inner -->
</div><!-- #content -->

<?php optime_search_popup(); ?>

<?php optime_footer(); ?>

<?php if (isset($back_totop_on) && $back_totop_on) : ?>
    <a href="#" class="scroll-top default"><i class="zmdi zmdi-long-arrow-up"></i></a>
<?php endif; ?>

<?php optime_contact_form(); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
