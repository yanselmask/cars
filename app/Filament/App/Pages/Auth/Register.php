<?php

namespace App\Filament\App\Pages\Auth;

use Filament\Facades\Filament;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected  function beforeFill()
    {
        if(Filament::auth()->check()) {
            if(auth()->user()->isSeller() || auth()->user()->isSuperAdmin())
            {
                redirect()->intended(Filament::getUrl());
            }

            redirect()->intended(getPath('vendor',true) . 'edit-profile');
        }
    }
    protected function afterRegister()
    {
        $model = $this->form->model;

        if($this->form->getLivewire()->data['role'] == 'seller')
        {
            $model->assignRole(config('listing.seller_role'));
        }else{
            $model->assignRole('User');
        }
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getRoleFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getRoleFormComponent(): Component
    {
        return Radio::make('role')
            ->label(__('Register as'))
            ->options([
                'user' => 'User',
                'seller' => 'Seller',
            ])
            ->inline()
            ->inlineLabel(false)
            ->default('user')
            ->required();
    }
}
