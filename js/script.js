$(document).ready(function(){

    //hilangkan tombol button
        $('#tombol-cari').hide();

        $('#keyword').on('keyup', function(){
            // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
            $('.loading').show();

            $.get('ajax/mahasiswa.php?keyword='+ $('#keyword').val(), function(data){
                $('#container').html(data); 

                $('.loading').hide();    
            });
        });
});