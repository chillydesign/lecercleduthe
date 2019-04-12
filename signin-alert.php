
<?php if(  get_current_user_id( )  ==  0  ) : ?>



    <div class="container">
        <a class="black_box"  href="<?php echo  esc_url( wc_get_page_permalink('myaccount')); ?>?register=professional">
            Avez-vous un compte professionnel? Connectez-vous ou créez un compte pour bénéficier de réductions et de produits exclusifs.
        </a>
    </div>


<?php endif; ?>
