<style>
    .drop{
        position: relative;
        display: inline-block; 
        margin-left: 15px;
        line-height: 30px;
        vertical-align: center;

    }
    .drop:hover{
        color: white;
    }
    .navinha{
        text-decoration: none;
        list-style: none;
        color: #333;
        padding: 0;
    }
    .navinha a{
        color: #333;

    }
    .drop-content{
        display: none;
        position: absolute;
        min-width: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        border-radius: 10px;
        color: #333;
        text-decoration: none;
        z-index: 1;
        margin: 0;
        background-color: #229DFF;

    }
    .drop:hover .drop-content{
        display: block;
    }
    .drop-content ul li:hover{
        background-color: #007BFF;
        border-radius: 10px;

    }
    .drop-content ul li a:hover{
        color: white;
    }
    .point{
        cursor: pointer;
    }
    .drop-content ul li a{
        color: white;
    }
    
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">

    <a class="navbar-brand" href="{{url('/')}}">Estacionamento</a>  
    <div class="drop">
         <span class="point">Clientes </span>
         <span class="glyphicon glyphicon-chevron-down" style="cursor: pointer;color:#353535;"> </span>
        <div class="drop-content">
            <ul class="navinha">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('clientes.index')}}">Mensalistas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('clientes.create')}}">Novo Mensalista</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('avulso.index')}}">Avulso</a>
                </li>
            </ul>
        </div>
    </div>
     <div class="drop">
        <span class="point">Sistema </span>
        <span class="point glyphicon glyphicon-chevron-down" style="color:#353535;"> </span> 
        <div class="drop-content">
    <ul class="navinha">

        <li class="navinha-item">
            <a class="nav-link" href="{{route('carros.index')}}">Carros</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('precos.index')}}">Preços</a>
        </li>
    </ul>
        </div>
     </div>
</div>
</nav>
