			</div><?php // container  ?>
		<div id="push"></div><?php // sticky footer  ?>
		</div><?php // end #wrap  ?>

		<footer id="footer" role="contentinfo">

			<div id="inner-footer" class="container">

				<nav role="navigation">
						<?php bones_footer_links(); ?>
				</nav>

				<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

			</div> <?php // end #inner-footer ?>

		</footer> <?php // end footer ?>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <?php // end page. what a ride! ?>
