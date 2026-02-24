<div
    x-data="{}"
    x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('filament-socialite-styles', package: 'filament-socialite'))]"
>
    @php
        $isRegisterPage = str_contains((string) request()->route()?->getName(), '.auth.register');
        $dividerLabel = $isRegisterPage
            ? __('filament-socialite::auth.register-via')
            : __('filament-socialite::auth.login-via');

        $googleIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 48 48" aria-hidden="true" focusable="false" style="display: block;">
            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
            <path fill="none" d="M0 0h48v48H0z"></path>
        </svg>';
    @endphp

    <div class="flex flex-col gap-y-6">
        @if ($messageBag->isNotEmpty())
            @foreach($messageBag->all() as $value)
                <p class="fi-fo-field-wrp-error-message text-danger-600 dark:text-danger-400">{{ __($value) }}</p>
            @endforeach
        @endif

        @if (count($visibleProviders))
            @if($showDivider)
                <div class="relative flex items-center justify-center text-center">
                    <div class="absolute border-t border-gray-200 w-full h-px"></div>
                    <p class="inline-block relative bg-white dark:bg-gray-900 text-sm px-4 p-2 font-medium">
                        {{ $dividerLabel }}
                    </p>
                </div>
            @endif

            <div class="grid @if(count($visibleProviders) > 1) grid-cols-2 @endif gap-4">
                @foreach($visibleProviders as $key => $provider)
                    <x-filament::button
                        :color="$provider->getColor()"
                        :outlined="$provider->getOutlined()"
                        :icon="$key === 'google' ? null : $provider->getIcon()"
                        tag="a"
                        :href="route($socialiteRoute, $key)"
                        :spa-mode="false"
                    >
                        @if($key === 'google')
                            <span class="inline-flex items-center gap-2">
                                {!! $googleIcon !!}
                                <span>{{ $provider->getLabel() }}</span>
                            </span>
                        @else
                            {{ $provider->getLabel() }}
                        @endif
                    </x-filament::button>
                @endforeach
            </div>
        @else
            <span></span>
        @endif
    </div>
</div>
