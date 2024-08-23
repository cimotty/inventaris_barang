<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NewsTable extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fileImport;
    public $post;
    public $postIdBeingDeleted = null;
    public $iteration = 0;
    public $orderBy = 'created_at';
    public $orderDirection = 'desc';
    public $perPage = 25;
    public $search = '';
    public $selectedRows = [];
    public $selectPageRows = false;
    public $showDeleteModal = false;
    public $showUpdateModal = false;
    public $state = [];

    public $judul, $keterangan, $pdf, $namaPdf, $created_at;
    
    // Limit Characters
    public function limitCharacters($string, $charLimit)
    {
        if (strlen($string) <= $charLimit) {
            return $string;
        }

        return substr($string, 0, $charLimit) . '...';
    }
    // End Limit Characters

    // Sorting
    public function orderBy($field)
    {
        if ($this->orderBy === $field) {
            $this->orderDirection = $this->swapOrderDirection();
        } else {
            $this->orderDirection = 'asc';
        }

        $this->orderBy = $field;
    }

    public function swapOrderDirection()
    {
        return $this->orderDirection === 'asc' ? 'desc' : 'asc';
    }
    // End Sorting

    // Validation
    protected $rules = [
        'judul' => ['required', 'min:3', 'max:100'],
        'keterangan' => ['required', 'min:1', 'max:500'],
        'pdf' => ['nullable', 'file', 'max:10240', 'mimes:pdf'],
        'namaPdf' => ['nullable', 'min:3', 'max:50'],
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    // End Validation

    // Searching
    public function getNewsProperty()
    {
        return News::search($this->search)
                ->orderBy($this->orderBy, $this->orderDirection)
                ->paginate($this->perPage);
    }

    public function updatingPerPage(): void
    {
        $this->gotoPage(1);
    }

    public function updatingSearch(): void
    {
        $this->gotoPage(1);
    }
    // End Searching

    // Select All
    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->news->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    // Delete Selected
    public function confirmDeleteSelectedRows()
    {
        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteSelectedRows()
    {
        $selectedNews = News::whereIn('id', $this->selectedRows)->get();

        News::whereIn('id', $this->selectedRows)->delete();

        foreach ($selectedNews as $post) {
            if ($post->pdf!=null) {
                Storage::disk('news')->delete($post->pdf);
            }
        }

        $this->reset(['selectedRows', 'selectPageRows']);
        $this->gotoPage(1);
        $this->dispatchBrowserEvent('hide-delete-modal');
        session()->flash('successMessage', 'Berita yang dipilih berhasil dihapus!');
    }
    // End Delete Selected

    // CRUD
    public function confirmPostCreate()
    {
        $this->fileImport = null;
        $this->iteration++;
        $this->reset();
        $this->resetValidation();
        
        $this->showUpdateModal = false;
        
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPost()
    {
        if ($this->pdf != null) {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
                'pdf' => ['nullable', 'file', 'max:10240', 'mimes:pdf'],
                'namaPdf' => ['required', 'min:3', 'max:50'],
            ]);
        } else if ($this->namaPdf != null) {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
                'pdf' => ['required', 'file', 'max:10240', 'mimes:pdf'],
                'namaPdf' => ['nullable', 'min:3', 'max:50'],
            ]);
        } else {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
                'pdf' => ['nullable', 'file', 'max:10240', 'mimes:pdf'],
                'namaPdf' => ['nullable', 'min:3', 'max:50'],
            ]);
        }

        if ($this->pdf) {
            $originalName = Str::slug($this->namaPdf);
            $counter = 1;
            $extension = $this->pdf->getClientOriginalExtension();
            $fileName = "{$originalName}-{$counter}.{$extension}";

            while (Storage::disk('news')->exists($fileName)) {
                $counter++;
                $fileName = "{$originalName}-{$counter}.{$extension}";
            }

            $validatedData['pdf'] = $this->pdf->storeAs('/', $fileName, 'news');
        }

        News::create($validatedData);

        $this->iteration++;
        
        $this->dispatchBrowserEvent('hide-form');
        session()->flash('successMessage', 'Berita berhasil dibuat!');
    }
    
    public function readPost(News $post)
    {
        $this->judul = $post->judul;
        $this->keterangan = $post->keterangan;
        $this->pdf = $post->pdf;
        $this->namaPdf = $post->namaPdf;
        $this->created_at = $post->created_at;

        $this->dispatchBrowserEvent('show-offcanvas');
    }
    
    public function confirmPostUpdate(News $post)
    {
        $this->showUpdateModal = true;

        $this->post = $post;

        $this->judul = $post->judul;
        $this->keterangan = $post->keterangan;
        $this->namaPdf = $post->namaPdf;
        
        $this->state = $post->toArray();

        $this->resetValidation();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updatePost()
    {
        if ($this->pdf != null) {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
                'pdf' => ['nullable', 'file', 'max:10240', 'mimes:pdf'],
                'namaPdf' => ['required', 'min:3', 'max:50'],
            ]);

            if ($this->post->pdf && Storage::disk('news')->exists($this->post->pdf)) {
                Storage::disk('news')->delete($this->post->pdf);
            }

            $originalName = Str::slug($this->namaPdf);
            $counter = 1;
            $extension = $this->pdf->getClientOriginalExtension();
            $fileName = "{$originalName}-{$counter}.{$extension}";

            while (Storage::disk('news')->exists($fileName)) {
                $counter++;
                $fileName = "{$originalName}-{$counter}.{$extension}";
            }

            $validatedData['pdf'] = $this->pdf->storeAs('/', $fileName, 'news');
        } else if ($this->post->pdf != null && $this->namaPdf !== $this->post->namaPdf) {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
                'pdf' => ['nullable', 'file', 'max:10240', 'mimes:pdf'],
                'namaPdf' => ['required', 'min:3', 'max:50'],
            ]);
            
            $originalName = Str::slug($this->namaPdf);
            $counter = 1;
            $extension = pathinfo($this->post->pdf, PATHINFO_EXTENSION);
            $fileName = "{$originalName}-{$counter}.{$extension}";
            
            Storage::disk('news')->move($this->post->pdf, '/' . $fileName);

            $validatedData['pdf'] = $fileName;
        } else {
            $validatedData = $this->validate([
                'judul' => ['required', 'min:3', 'max:100'],
                'keterangan' => ['required', 'min:1', 'max:500'],
            ]);
        }

        $this->post->update($validatedData);

        $this->iteration++;

        $this->dispatchBrowserEvent('hide-form');
        session()->flash('successMessage', 'Berita berhasil diubah!');
    }
    
    public function confirmPostDelete($id)
    {
        $this->postIdBeingDeleted = $id;
        $this->showDeleteModal = true;

        $this->dispatchBrowserEvent('show-delete-modal');
    }
    
    public function deletePost()
    {
        $post = News::findOrFail($this->postIdBeingDeleted);
        
        if ($post->pdf!=null) {
            Storage::disk('news')->delete($post->pdf);
        }

        $post->delete();

        $this->dispatchBrowserEvent('hide-delete-modal');
        session()->flash('successMessage', 'Berita berhasil dihapus!');
    } 
    // End CRUD

    public function render()
    {
        $news = $this->news;

        foreach ($news as $post) {
            $post->judul = $this->limitCharacters($post->judul, 40);
            $post->keterangan = $this->limitCharacters($post->keterangan, 70);
        }

        return view('livewire.news-table', [
            'news' => $news,
        ]);
    }
}
