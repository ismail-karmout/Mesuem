<style>
    .padding {
        padding: 100px;
        color: white;
    }

    .padding-1 {
        padding: 20px;
    }

    .image-bg {
        height: 150px;
        width: 100%;
        background-color: #000000;
        border-bottom: solid 5px #EC2E88;
    }

    .card {
        background-color: #222222;
        height: 300px;
        width: 100%;
    }

    .text {
        font-family: Georgia, serif;
        font-size: 17px;
        letter-spacing: 2px;
        word-spacing: 2px;
        color: #ffff;
        font-weight: 400;
        text-decoration: none;
        font-style: normal;
        font-variant: normal;
        text-transform: none;
    }

    ul {
        list-style-type: square;
        list-style-position: outside;
    }

    li {
        padding: 8px;
        margin: 0px;
    }
</style>

<div class="padding">
    <div class="image-bg">
        <div class="padding-1">

            <h1 style=" font-size: 40px"><strong style="color: #EC2E88;">Museum</strong>Admin</h1>
        </div>
    </div>
    <div class="card">

        <div class="padding-1">
            <h1>{{ $details['title']}}</h1> 
            <p class="text">
                Bonjour Mr/Mme {{ $details['name']}}.
            </p>
            <p class="text">
            <ul>
                <li>Email : {{ $details['email']}}</li>
                <li>Mot de passe : {{ $details['password']}}</li>
            </ul>
            </p>
           

        </div>
    </div>

</div>

