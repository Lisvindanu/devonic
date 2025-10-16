<?php
namespace App\Filament\Resources;
use App\Filament\Resources\AboutContentResource\Pages;
use App\Filament\Resources\AboutContentResource\RelationManagers;
use App\Models\AboutContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class AboutContentResource extends Resource
{
    protected static ?string $model = AboutContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Halaman About';
    protected static ?string $modelLabel = 'Konten About';
    protected static ?string $pluralModelLabel = 'Konten About';
    protected static ?int $navigationSort = 7;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Konten')
                    ->schema([
                        Forms\Components\Select::make('section')
                            ->label('Bagian')
                            ->required()
                            ->options([
                                'about' => 'Tentang Kami',
                                'principles' => 'Prinsip Inti',
                                'programs' => 'Program',
                            ]),
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('subtitle')
                            ->label('Sub Judul')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('icon')
                            ->label('Icon')
                            ->maxLength(255)
                            ->helperText('Nama class icon'),
                        Forms\Components\Textarea::make('content')
                            ->label('Konten')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('about/images')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
            'index' => Pages\ListAboutContents::route('/'),
            'create' => Pages\CreateAboutContent::route('/create'),
            'edit' => Pages\EditAboutContent::route('/{record}/edit'),
        ];
    }
}
