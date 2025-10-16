<?php
namespace App\Filament\Resources;
use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class PackageResource extends Resource
{
    protected static ?string $model = Package::class;
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Konten Management';
    protected static ?string $modelLabel = 'Paket';
    protected static ?string $pluralModelLabel = 'Paket';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category')
                            ->label('Kategori')
                            ->required()
                            ->options([
                                's1' => 'Paket S1',
                                's2-s3' => 'Paket S2/S3',
                                'custom' => 'Custom Project',
                                'donation' => 'Donasi',
                            ]),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon')
                            ->maxLength(255)
                            ->helperText('Nama class icon'),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Harga')
                    ->schema([
                        Forms\Components\TextInput::make('price_min')
                            ->label('Harga Minimum')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Harga terendah'),
                        Forms\Components\TextInput::make('price_max')
                            ->label('Harga Maximum')
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Harga tertinggi (kosongkan jika harga tetap)'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Detail Paket')
                    ->schema([
                        Forms\Components\TagsInput::make('features')
                            ->label('Fitur-fitur')
                            ->helperText('Masukkan fitur satu per satu')
                            ->placeholder('Tulis fitur lalu Enter')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('target_beneficiaries')
                            ->label('Target Penerima Manfaat')
                            ->numeric()
                            ->helperText('Jumlah mahasiswa yang dibantu'),
                        Forms\Components\TextInput::make('service_type')
                            ->label('Jenis Layanan')
                            ->maxLength(255)
                            ->helperText('Contoh: Website, Mobile App, Branding'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Unggulan')
                            ->default(false)
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(3),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('price_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('target_beneficiaries')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service_type')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        's1' => 'S1 Package',
                        's2-s3' => 'S2/S3 Package',
                        'custom' => 'Custom Package',
                        'donation' => 'Donation',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->boolean()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->boolean()
                    ->native(false),
            ])
            ->defaultSort('order', 'asc')
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
