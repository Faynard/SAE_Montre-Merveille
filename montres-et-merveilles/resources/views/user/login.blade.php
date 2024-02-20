@extends('layouts.default')

@section('content')
    <div class="flex min-h-[calc(90vh)] justify-center items-center mb-28">
        <div class="flex flex-col justify-center w-7/12 gap-y-8">
            <h1 class="uppercase text-5xl">Se connecter</h1>
            <p>Votre compte personnel vous permet d'enregistrer vos montres dans un panier et de passer commande.</p>
            <div class="bg-[#F3F3F3] h-14 flex items-center gap-2 pl-6">
                <span>Vous n'avez pas encore de compte ?</span>
                <a href="{{ route('user.register') }}" class="font-bold underline">Inscrivez-vous</a>
            </div>
            <form action="{{ route('user.login') }}" method="post" class="flex flex-col gap-y-8">
                @csrf
                <x-forms.input type="email" name="email" label="E-mail" placeholder="Entrer votre adresse email" />
                @error('email')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror
                <x-forms.input type="password" name="password" label="mot de passe" placeholder="Entrer votre mot de passe" />
                @error('password')
                    <x-forms.error>{{ $message }}</x-forms.error>
                @enderror
                <x-forms.button text="Se connecter" />
            </form>
        </div>
    </div>
@endsection
