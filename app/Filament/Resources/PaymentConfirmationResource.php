<?php
namespace App\Filament\Resources;
use App\Filament\Resources\PaymentConfirmationResource\Pages;
use App\Filament\Resources\PaymentConfirmationResource\RelationManagers;
use App\Models\PaymentConfirmation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class PaymentConfirmationResource extends Resource
{
    protected static ?string $model = PaymentConfirmation::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Pesan Masuk';
    protected static ?string $modelLabel = 'Konfirmasi Pembayaran';
    protected static ?string $pluralModelLabel = 'Konfirmasi Pembayaran';
    protected static ?int $navigationSort = 11;
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
                        Forms\Components\Select::make('package_id')
                            ->label('Paket')
                            ->relationship('package', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Detail Transfer')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('Jumlah Transfer')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\DatePicker::make('transfer_date')
                            ->label('Tanggal Transfer')
                            ->required(),
                        Forms\Components\TextInput::make('transfer_time')
                            ->label('Waktu Transfer'),
                        Forms\Components\TextInput::make('bank_account')
                            ->label('Rekening Tujuan')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sender_bank')
                            ->label('Bank Pengirim')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('sender_account_name')
                            ->label('Nama Rekening Pengirim')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('proof_image')
                            ->label('Bukti Transfer')
                            ->image()
                            ->directory('payment-proofs')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('message')
                            ->label('Pesan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('Verifikasi Admin')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'pending' => 'Menunggu Verifikasi',
                                'verified' => 'Terverifikasi',
                                'rejected' => 'Ditolak',
                            ])
                            ->default('pending'),
                        Forms\Components\Select::make('verified_by')
                            ->label('Diverifikasi Oleh')
                            ->relationship('verifiedBy', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\DateTimePicker::make('verified_at')
                            ->label('Tanggal Verifikasi'),
                        Forms\Components\Textarea::make('admin_notes')
                            ->label('Catatan Admin')
                            ->rows(3)
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transfer_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('transfer_time'),
                Tables\Columns\TextColumn::make('bank_account')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sender_bank')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sender_account_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('proof_image'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('verified_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verified_at')
                    ->dateTime()
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
            'index' => Pages\ListPaymentConfirmations::route('/'),
            'create' => Pages\CreatePaymentConfirmation::route('/create'),
            'edit' => Pages\EditPaymentConfirmation::route('/{record}/edit'),
        ];
    }
}
