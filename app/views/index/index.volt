<div class="container">
    <h2>Prueba de Envío de Correo</h2>
    <form action="{{ url('mail/send') }}" method="post">
        <div class="form-group">
            <label for="title">Titulo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titulo">
        </div>
        <div class="form-group">
            <label for="email">Password</label>
            <input type="text" class="form-control" id="email" name=email placeholder="email">
        </div>
        <div class="form-group">
            <label for="message">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
    </form>
</div>