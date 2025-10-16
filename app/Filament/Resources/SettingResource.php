<?php
namespace App\Filament\Resources;
use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $modelLabel = 'Pengaturan';
    protected static ?string $pluralModelLabel = 'Pengaturan';
    protected static ?int $navigationSort = 20;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Setting')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Kunci')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nama unik untuk setting (contoh: site_name)'),
                        Forms\Components\TextInput::make('label')
                            ->label('Label')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Nama yang ditampilkan'),
                        Forms\Components\Select::make('type')
                            ->label('Tipe')
                            ->required()
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'number' => 'Number',
                                'boolean' => 'Boolean',
                                'json' => 'JSON',
                            ]),
                        Forms\Components\TextInput::make('group')
                            ->label('Grup')
                            ->maxLength(255)
                            ->helperText('Grup setting (contoh: payment, contact)'),
                        Forms\Components\Textarea::make('value')
                            ->label('Nilai')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('group')
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ])
            ]);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
