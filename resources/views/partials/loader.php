<style> .flex{display: flex} </style>
<div id="loader"
class="bg-black opacity-75 fixed-top vw-100 vh-100 flex" 
style="display: none; z-index: 1500">
  <img src="<?= \App\Helpers\Assets::load("images/loader.png") ?>" alt="loader" class="m-auto">
</div>