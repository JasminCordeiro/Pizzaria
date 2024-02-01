
function atualizarPrecoTotal() {
    var precoTotal = 0;

    $('select[name="tamanho"], select[name="borda"], select[name="massa"]').each(function() {
        var precoSelecionado = parseFloat($(this).find(':selected').data('preco')) || 0;
        precoTotal += precoSelecionado;
    });

    $('select[name="ingredientes[]"] :selected').each(function() {
        var precoSelecionado = parseFloat($(this).data('preco')) || 0;
        precoTotal += precoSelecionado;
    });

    $('#precoTotal').text(precoTotal.toFixed(2).replace('.', ',')); 
}

$('select[name="tamanho"], select[name="borda"], select[name="massa"], select[name="ingredientes[]"]').change(function() {
    atualizarPrecoTotal();
});



