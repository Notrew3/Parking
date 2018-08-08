====================================<br>
<p>
    ESTACIONAMENTO SANTA ROSA LTDA<br>
    AV ZUMKELLER, 98 SS - AV SANTA INES, 133<br>
    CNPJ 24.232.312/0001-32<br>
    TEL 2232-3202
</p>
<p>
SAíDA Nº: {{$avs->id}}  - AVULSO
</p>
<p>
    Entrada: {{Carbon\Carbon::parse($avs->created_at)->format('d-M-Y')}} - {{Carbon\Carbon::parse($avs->created_at)->format('H:i:s')}}
</p>
<p>
    Saída: {{Carbon\Carbon::parse($avs->updated_at)->format('d-M-Y')}} - {{Carbon\Carbon::parse($avs->updated_at)->format('H:i:s')}}
</p>
<p>
    {{$avs->placa}} - {{$avs->carro()['nome']}}
</p>
<p>
    Total: R$ {{$precoTotal}},00
</p>
<p>
    NAO NOS RESPONSABILIZAMOS POR OBJETOS<br>
    DEIXADOS NO INTERIOR DO VEICULO<br>
</p>
=====================================