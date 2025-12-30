<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class TestingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $statistics = Author::query()
            ->select([
                'books.id',
                'books.title',
                'books.rating',
            ])->addSelect(new Expression("group_concat(' ', authors.name) as authors"))
            ->distinct()
            ->join('authors_books_pivot', 'authors.id', '=', 'authors_books_pivot.author_id')
            ->join('books', 'books.id', '=', 'authors_books_pivot.book_id')
            ->where('rating', '>=', function (Builder $query) {
                $query->selectRaw('AVG(rating)')->from('books');
            })->groupBy('books.id')
            ->get();

        dd($statistics);

    }
}
