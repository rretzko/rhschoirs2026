<?php

declare(strict_types=1);

namespace App\Livewire\Alumni;

use App\Models\Student;
use Illuminate\Support\Collection;
use Livewire\Component;

class AlumniBrowser extends Component
{
    public string $search = '';

    public ?int $selectedYear = null;

    public ?int $selectedStudentId = null;

    public function updatedSearch(): void
    {
        $this->selectedYear = null;
        $this->selectedStudentId = null;
    }

    public function selectYear(int $year): void
    {
        $this->selectedYear = $year;
        $this->selectedStudentId = null;
        $this->search = '';
    }

    public function selectStudent(int $id): void
    {
        $student = Student::find($id);

        if ($student) {
            $this->selectedYear = $student->class_of;
            $this->selectedStudentId = $id;
        }
    }

    public function previousYear(): void
    {
        if (! $this->selectedYear) {
            return;
        }

        $prevYear = $this->years
            ->filter(fn (int $year) => $year < $this->selectedYear)
            ->last();

        if ($prevYear) {
            $this->selectedYear = $prevYear;
            $this->selectedStudentId = null;
        }
    }

    public function nextYear(): void
    {
        if (! $this->selectedYear) {
            return;
        }

        $nextYear = $this->years
            ->filter(fn (int $year) => $year > $this->selectedYear)
            ->first();

        if ($nextYear) {
            $this->selectedYear = $nextYear;
            $this->selectedStudentId = null;
        }
    }

    public function clearSelection(): void
    {
        $this->selectedYear = null;
        $this->selectedStudentId = null;
        $this->search = '';
    }

    public function getYearsProperty(): Collection
    {
        return Student::validYear()
            ->selectRaw('DISTINCT class_of')
            ->orderBy('class_of')
            ->pluck('class_of');
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
        if (! $this->selectedYear) {
            return collect();
        }

        return Student::validYear()
            ->where('class_of', $this->selectedYear)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();
    }

    public function getHasPreviousYearProperty(): bool
    {
        if (! $this->selectedYear) {
            return false;
        }

        return $this->years->contains(fn (int $year) => $year < $this->selectedYear);
    }

    public function getHasNextYearProperty(): bool
    {
        if (! $this->selectedYear) {
            return false;
        }

        return $this->years->contains(fn (int $year) => $year > $this->selectedYear);
    }

    public function render()
    {
        return view('livewire.alumni.alumni-browser');
    }
}
