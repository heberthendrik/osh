$(function(){
    $('#no_rm').keyup(function(){
        var no_rm = this.value;
        if(no_rm) {
            $.get("/getDataDetail/"+no_rm, function(data){
                $('#nama').val(data['nama']);
                $('#alamat').val(data['alamat']);
                $('#sex').val(data['sex']);
                $('#tgl_lahir').val(data['tgl_lahir']);
            });
        }

    })
});
