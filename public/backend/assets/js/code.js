$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
  
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Supprimer cet enregistrement ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                'Supprimé!',
                'Enregistrement supprimé avec succès.',
                'success'
                )
            }
        }) 
    });
});

