<div>
    <h1>Registro</h1>
    <p>Um paragrafo</p>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <x-filament-support::button type="submit" wire:target="submit" class="my-4">Salvar</x-filament-support::button>
    </form>
</div>
