<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('map.index') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>
        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Projects')" class="grid">

                <flux:navlist.item icon="arrow-path" :href="route('map.index')"
                    :current="request()->routeIs('map.index')" wire:navigate>{{ __('Active')
                    }}</flux:navlist.item>

                <flux:navlist.item icon="check-circle" :href="route('map.finished')"
                    :current="request()->routeIs('map.finished')" wire:navigate>{{ __('Completed')
                    }}</flux:navlist.item>


            </flux:navlist.group>

            <flux:navlist.group :heading="__('Maps')" class="grid">

                <flux:navlist.item icon="globe-asia-australia" :href="route('map.view')"
                    :current="request()->routeIs('map.view')">{{ __('Active')
                    }}</flux:navlist.item>

                <flux:navlist.item icon="globe-asia-australia" :href="route('map.complete')"
                    :current="request()->routeIs('map.finish')">{{ __('Completed')
                    }}</flux:navlist.item>

            </flux:navlist.group>
        </flux:navlist>


        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            {{--
            <flux:profile :initials="auth()->user()->username" icon:trailing="chevrons-up-down" /> --}}

            <flux:profile icon:trailing="chevrons-up-down" />


            <flux:menu class="w-[220px]">

                <div class="p-2 text-sm rounded bg-gray-100 dark:bg-gray-800">User: {{auth()->user()->username}}</div>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile icon-trailing="chevron-down" />

            <flux:menu>

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts

    <livewire:flash-alert />
    <livewire:map.view-description-modal />
    <livewire:map.edit-modal />
    <livewire:map.add-modal />
    <livewire:map.finish-modal />
    <livewire:map.delete-modal />
    <livewire:map.file-upload-modal />
    <livewire:map.view-image-modal />
    <livewire:map.open-video-image-modal />
    <livewire:settings.change-modal />
    <livewire:map.delete-file-modal />
    

</body>

</html>