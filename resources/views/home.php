<?php $this->layout('main', ['title' => 'Nice Site']) ?>

<h1>Nice site</h1>

<div id="app">
    <app name="<?=$this->e($name)?>"></app>
</div>

<?php $this->push('scripts') ?>
    <script src="/js/app.js"></script>
<?php $this->end() ?>