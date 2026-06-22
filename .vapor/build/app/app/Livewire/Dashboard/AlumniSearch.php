<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\Student;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property-read Collection<int, Student> $searchResults
 * @property-read Collection<int, Student> $classList
 * @property-read Student|null $selectedStudent
 * @property-read int $alumniCount
 */
class AlumniSearch extends Component
{
    public string $search = '';

    public ?int $selectedStudentId = null;

    public function updatedSearch(): void
    {
        $this->selectedStudentId = null;
    }

    public function selectStudent(int $id): void
    {
        $this->selectedStudentId = $id;
    }

    public function clearSelection(): void
    {
        $this->selectedStudentId = null;
        $this->search = '';
    }

    public function getSearchResultsProperty(): Collection
    {
        if (strlen($this->search) < 2) {
            return collect();
        }

        return Student::validYear()
            ->search($this->search)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

    public function getClassListProperty(): Collection
    {
        if (! $this->selectedStudentId) {
            return collect();
        }

        /** @var Student|null $student */
        $student = Student::find($this->selectedStudentId);

        if (! $student) {
            return collect();
        }

        return Student::validYear()
            ->where('class_of', $student->class_of)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

    public function getSelectedStudentProperty(): ?Student
    {
        if (! $this->selectedStudentId) {
            return null;
        }

        /** @var Student|null */
        return Student::find($this->selectedStudentId);
    }

    public function getAlumniCountProperty(): int
    {
        return Student::validYear()->count();
    }

    public function render()
    {
        return view('livewire.dashboard.alumni-search');
    }
}
