<?php

namespace App\Http\Livewire;

use Filament\Forms\Components\Grid;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/**
 * Summary of RegisterForm
 */
class RegisterForm extends Component implements Forms\Contracts\HasForms
{

    use Forms\Concerns\InteractsWithForms;

    public array $data = [];
    /**
     * Summary of render
     * @return View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.register-form');
    }

    public function mount(): void
    {
        $this->form->fill([
            'first_name' => Fake()->firstName(),
            'last_name' => Fake()->lastName(),
            'email' => Fake()->email(),
            'company' => Fake()->company(),
            'phone_number' => Fake()->phoneNumber(),
            'website' => Fake()->url(),
            'unique_visitors' => Fake()->numberBetween(1, 100),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make('Conta')
                    ->schema([
                        TextInput::make('email')
                            ->label('E-mail user')
                            ->email()
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('first_name')
                            ->rule('min:3')
                            ->label('Nome')
                            ->required(),
                        TextInput::make('last_name')
                            ->label('Sobrenome')
                            ->required(),
                        TextInput::make('company')
                            ->label('Empresa')
                            ->required(),
                        TextInput::make('phone_number')
                            ->label('Telefone')
                            ->required(),
                        TextInput::make('website')
                            ->label('Site')
                            ->url()
                            ->required(),
                        TextInput::make('unique_visitors')
                            ->label('Visitantes Únicos')
                            ->numeric()
                            ->required(),
                        TextInput::make('password')
                            ->confirmed()
                            ->label('Senha')
                            ->password()
                            ->required(),
                        TextInput::make('password_confirmation')
                            ->label('Confirme a senha')
                            ->password()
                            ->required(),
                        Checkbox::make('terms')
                            ->label('Eu concordo com os termos e condições.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                     Step::make('Endereço')
                    ->schema([
                        TextInput::make('postal_code')
                            ->label('CEP')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('street')
                            ->label('Logradouro')
                            ->required()
                            ->columnSpan(2),
                        
                    ]),
            ])
            ->startOnStep(2),
        ];
    }

    /**
     * Summary of submit
     * @return void
     */
    public function submit(): void
    {
        // sleep(1);
        $this->data = $this->form->getState();
    }
}