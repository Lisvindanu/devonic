<?php
namespace App\Filament\Resources;
use App\Filament\Resources\PortfolioResource\Pages;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Konten Management';
    protected static ?string $modelLabel = 'Portfolio';
    protected static ?string $pluralModelLabel = 'Portfolio';
    protected static ?int $navigationSort = 3;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Project')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('client_name')
                            ->label('Nama Client')
                            ->maxLength(255),
                        Forms\Components\Select::make('service_id')
                            ->label('Layanan')
                            ->relationship('service', 'name')
                            ->required()
                            ->preload(),
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Detail Project')
                    ->schema([
                        Forms\Components\Textarea::make('challenge')
                            ->label('Tantangan')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('solution')
                            ->label('Solusi')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('result')
                            ->label('Hasil')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('Media & Link')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail')
                            ->label('Thumbnail')
                            ->required()
                            ->image()
                            ->directory('portfolios/thumbnails')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('project_url')
                            ->label('URL Project')
                            ->url()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('completed_at')
                            ->label('Tanggal Selesai'),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Unggulan')
                            ->default(false)
                            ->required(),
                        Forms\Components\Toggle::make('is_published')
                            ->label('Dipublikasi')
                            ->default(true)
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project_url')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
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
                Tables\Filters\SelectFilter::make('service')
                    ->relationship('service', 'name'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->boolean()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('is_published')
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
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
