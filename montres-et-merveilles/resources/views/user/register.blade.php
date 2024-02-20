@extends('layouts.default')

@section('content')
    <div class="flex min-h-[calc(90vh)] justify-center items-center mt-8 mb-28">
        <div class="flex flex-col justify-center w-7/12 gap-y-8">
            <h1 class="uppercase text-5xl">Créer un compte</h1>
            <p>Votre compte personnel vous permet d'enregistrer vos montres dans un panier et de passer commande.</p>
            <div class="bg-[#F3F3F3] h-14 flex items-center gap-2 pl-6">
                <span>Vous avez déjà un compte ?</span>
                <a href="{{ route('user.login') }}" class="font-bold underline">Se connecter</a>
            </div>
            <form action="{{ route('user.register') }}" method="POST" class="flex flex-col gap-y-8">
                @csrf

                <div class="flex gap-4">
                    <x-forms.input type="text" name="firstname" label="prénom" placeholder="Indiquez votre prénom" class="w-1/2" />
                    @error('lastname')
                        <div>
                            <x-forms.error>{{ $message }}</x-forms.error>
                        </div>
                    @enderror
    
                    <x-forms.input type="text" name="lastname" label="nom" placeholder="Indiquez votre nom" class="w-1/2" />
                    @error('firstname')
                        <div>
                            <x-forms.error>{{ $message }}</x-forms.error>
                        </div>
                    @enderror
                </div>

                <x-forms.input type="email" name="email" label="E-mail" placeholder="Entrer votre adresse email" />
                @error('email')
                    <div>
                        <x-forms.error>{{ $message }}</x-forms.error>
                    </div>
                @enderror

                <x-forms.input type="password" name="password" label="créez un mot de passe"
                    placeholder="Entrer votre mot de passe" />
                @error('password')
                    <div>
                        <x-forms.error>{{ $message }}</x-forms.error>
                    </div>
                @enderror

                <x-forms.input type="password" name="password_confirmation" label="confirmez votre mot de passe"
                    placeholder="Entrer votre mot de passe" />
                @error('password')
                    <div>
                        <x-forms.error>{{ $message }}</x-forms.error>
                    </div>
                @enderror

                <x-forms.button text="S'inscrire" />
            </form>
        </div>
    </div>
@endsection
