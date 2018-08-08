====================================<br>
<p>
    ESTACIONAMENTO SANTA ROSA LTDA<br>
    AV ZUMKELLER, 98 SS - AV SANTA INES, 133<br>
    CNPJ 24.232.312/0001-32<br>
    TEL 2232-3202
</p>
<p>
Entrada Nº: {{$insert->id}}  - AVULSO
</p>
<p>
    {{Carbon\Carbon::parse($insert->created_at)->format('d-M-Y')}} - {{Carbon\Carbon::parse($insert->created_at)->format('H:i:s')}}
</p>
<p>
    {{$insert->placa}} - {{$insert->carro()['nome']}}
</p>
<p>
    NAO NOS RESPONSABILIZAMOS POR OBJETOS<br>
    DEIXADOS NO INTERIOR DO VEICULO<br>
</p>
=====================================

