function addQ(d) {
    var content = $('.times');
    var newQ = `
            <div class="row form-group mt-3" id="Q_` + content.length + `">
                <div class="col-md-10">
                    <input name="authors[]" class="form-control authXX">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger times btn-sm" onclick="deleteQ('Q_` + content.length + `')" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                </div>
            </div>
        `;
    $('#all-attributes-' + d).append(newQ);
}

function deleteQ(d) {
    $('#' + d).remove();
}