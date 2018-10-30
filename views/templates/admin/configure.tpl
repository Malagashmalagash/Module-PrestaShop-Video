<form method="POST" enctype="multipart/form-data">
    <div class="panel">
        <div class="panel-heading">
            {l s='Configuration' mod='videobannerdisplay'}
        </div>
        <div class="panel-body">
                <label for="title">{l s='Titre sur la vidéo' mod='videobannerdisplay'}</label>
                <input type="text" name="title" id="title" class="form-control" value="{$VIDEOBANNERDISPLAY_STR}">
        </div>
        <div class="panel-body">
            <label for="description">{l s='Descriptif sur la vidéo' mod='videobannerdisplay'}</label>
            <input type="text" name="description" id="description" class="form-control" value="{$DESCRIPTION_STR}">
        </div>

        <div class="panel-body">
            <input type="file" name="video" accept="video/*">
        </div>

        <div class="panel-footer">
            <button type="submit" name="submit_form" class="btn btn-primary pull-right">
                <i class="process-icon-save"></i>
                {l s='Save' mod='videobannerdisplay'}
            </button>
        </div>
    </div>
</form>