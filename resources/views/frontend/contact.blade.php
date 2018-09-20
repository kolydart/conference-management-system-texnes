@extends('frontend.app')

@section('content')

<div class="row">
	<div class="col-md-8 offset-md-2">
		
	<?php
	\gateweb\common\Framework::set_language(\gateweb\common\Framework::LANG_EL);
	$contact = new \gateweb\common\mailer\Contact('texnes_sxoleio@theatre.uoa.gr');
	$contact->set_bcc('kolydart@music.uoa.gr');
	$contact->set_from("texnes_sxoleio@theatre.uoa.gr",'ΟΙ ΤΕΧΝΕΣ ΣΤΟ ΕΛΛΗΝΙΚΟ ΣΧΟΛΕΙΟ');
	$contact->exec();

	?>
	</div>
	
</div>

	
@endsection