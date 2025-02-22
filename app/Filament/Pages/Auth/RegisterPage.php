<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Hash;

class RegisterPage extends BaseRegister
{
    protected ?string $maxWidth = '4xl';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Profile')
                        ->icon('heroicon-o-user')
                        ->description('Tell us about yourself.')
                        ->schema([
                            TextInput::make('full_name')
                                ->label('Full Name')
                                ->placeholder('Ella Harizon')
                                ->required(),
                            Select::make('role')
                                ->label('Role')
                                ->live()
                                ->options([
                                    'student' => 'Student',
                                    'staff' => 'Staff',
                                ])
                                ->required()
                                ->default('student'),
                            TextInput::make('occupation')
                                ->label('Occupation')
                                ->placeholder('Occupation')
                                ->visible(fn(Get $get) => $get('role') === 'staff')
                                ->required(),
                            TextInput::make('university_registration_no')
                                ->label('Student ID')
                                ->unique('students', 'university_registration_no')
                                ->placeholder('University Registration Number')
                                ->visible(fn(Get $get) => $get('role') === 'student')
                                ->required(),
                            TextInput::make('uk_NIC')
                                ->label('NIC')
                                ->unique('users', 'uk_NIC')
                                ->placeholder('NIC')
                                ->required(),
                            TextInput::make('phone_number')
                                ->label('Phone')
                                ->placeholder('Phone')
                                ->required(),
                        ]),
                    Wizard\Step::make('Account')
                        ->icon('heroicon-o-key')
                        ->description('Create your account.')
                        ->schema([
                            $this->getEmailFormComponent(),
                            TextInput::make('uk_password')
                            ->label(__('filament-panels::pages/auth/register.form.password.label'))
            ->password()
            ->revealable(filament()->arePasswordsRevealable())
            ->required()
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->same('passwordConfirmation')
            ->validationAttribute(__('filament-panels::pages/auth/register.form.password.validation_attribute')),
                            $this->getPasswordConfirmationFormComponent(),
                        ]),
                ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        type="submit"
                        size="sm"
                        wire:submit="register"
                    >
                        Register
                    </x-filament::button>
                    BLADE
                ))),
            ]);
    }

    protected function getFormActions(): array
    {
        return [];
    }

    protected function handleRegistration(array $data): Model
    {
        // throw new \Exception("handleRegistration is running!");
        // dd("handleRegistration called!", $data);

        $user = parent::handleRegistration([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'uk_password' => $data['uk_password'],
            'phone_number' => $data['phone_number'],
            'uk_NIC' => $data['uk_NIC'],
        ]);

        match ($data['role']) {
            'staff' => $user->staff()->create([
                'occupation' => $data['occupation'],
            ]),
            'student' => $user->student()->create([
                'university_registration_no' => $data['university_registration_no'],
            ]),
        };

        return $user;
    }

}
