<?php
namespace App\Filament\Resources;
use App\Filament\Resources\ContactInquiryResource\Pages;
use App\Filament\Resources\ContactInquiryResource\RelationManagers;
use App\Models\ContactInquiry;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class ContactInquiryResource extends Resource
{
    protected static ?string $model = ContactInquiry::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Pesan Masuk';
    protected static ?string $modelLabel = 'Pesan Kontak';
    protected static ?string $pluralModelLabel = 'Pesan Kontak';
    protected static ?int $navigationSort = 10;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pengirim')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('company')
                            ->label('Perusahaan')
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Detail Pesan')
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->label('Layanan yang Diminati')
                            ->relationship('service', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('package_id')
                            ->label('Paket yang Diminati')
                            ->relationship('package', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Status & Tindak Lanjut')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'new' => 'Baru',
                                'in_progress' => 'Sedang Diproses',
                                'completed' => 'Selesai',
                                'spam' => 'Spam',
                            ])
                            ->default('new'),
                        Forms\Components\Toggle::make('is_read')
                            ->label('Sudah Dibaca')
                            ->default(false)
                            ->required(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('service.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\IconColumn::make('is_read')
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
            'index' => Pages\ListContactInquiries::route('/'),
            'create' => Pages\CreateContactInquiry::route('/create'),
            'edit' => Pages\EditContactInquiry::route('/{record}/edit'),
        ];
    }
}
