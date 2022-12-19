<div 
	class="position-fixed flex vh-100 vw-100 bg-black bg-opacity-75 top-0 start-0"
	style="z-index: 1030;"
	x-data="{ show: false, b: $('body'), data: { nota: '' } }"
	x-init="() => {
		$watch('show', val => b.toggleClass('overflow-hidden') );
	}"
	x-cloak x-show="show"
	@show-nota.document.stop="() => { 
		show = true; 
		data = $event.detail; 
		$nextTick( () => { setTimeout( $refs['nota-body'].scroll({ top: 0 }) ) })  
	}">
	<div @click.outside="show = false" x-ref="nota-body"
	class="p-4 overflow-auto rounded border bg-white small m-auto" style="max-width: 500px; max-height: 500px; width: 80vw; height: 80vh;">
		<h5>Nota:</h5>
		<p x-text="data.nota"></p>
	</div>
</div>