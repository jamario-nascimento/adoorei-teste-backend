$(function () {
    $('.excluir').on('click', function (e) {
        e.preventDefault();

        $("#spinnerLoading").show();

        if(confirm("Deseja realmente excluir este registro?")) {
            $.ajax({
                url: "/api/produto/delete",
                type: "DELETE",
                data: {id:$(this).attr('id')}
            }).done(function (resposta) {

            toastr.success('Registro Excluído com sucesso!', 'Excluir Produto', { timeOut: 6000 });

            setTimeout(window.location.href = "/produto/", 2000);

            $("#spinnerLoading").hide();
            }).fail(function (xhr, textStatus) {
                if(textStatus == 'error'){
                    toastr.error('Erro ao tentar Excluir', 'Excluir Produto', { timeOut: 6000 });
                }
                $("#spinnerLoading").hide();
            });
        }
    });
});
