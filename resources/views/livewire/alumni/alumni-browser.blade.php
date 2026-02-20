<div>
    <!-- Search Input -->
    <div class="mb-6 max-w-md">
        <flux:input
            wire:model.live.debounce.300ms="search"
            placeholder="Search alumni by name..."
            icon="magnifying-glass"
            clearable
        />
    </div>

    @if ($selectedYear)
        <!-- Class List Display with Year Navigation -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    @if ($this->hasPreviousYear)
                        <flux:button wire:click="previousYear" variant="ghost" size="sm" icon="chevron-left">
                            Previous Year
                        </flux:button>
                    @endif
                </div>

                <flux:heading size="lg">Class of {{ $selectedYear }}</flux:heading>

                <div class="flex items-center gap-3">
                    @if ($this->hasNextYear)
                        <flux:button wire:click="nextYear" variant="ghost" size="sm" icon-trailing="chevron-right">
                            Next Year
                        </flux:button>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <flux:button wire:click="clearSelection" variant="ghost" size="sm">
                    Back to Year List
                </flux:button>
            </div>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Name</flux:table.column>
                    <flux:table.column>Senior Year</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($this->classList as $student)
                        <flux:table.row :class="$student->id_students === $selectedStudentId ? 'bg-blue-50 dark:bg-blue-900/20' : ''">
                            <flux:table.cell>{{ $student->full_name }}</flux:table.cell>
                            <flux:table.cell>{{ $student->class_of }}</flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>

            <div class="flex items-center justify-between mt-4">
                <div>
                    @if ($this->hasPreviousYear)
                        <flux:button wire:click="previousYear" variant="ghost" size="sm" icon="chevron-left">
                            Previous Year
                        </flux:button>
                    @endif
                </div>
                <div>
                    @if ($this->hasNextYear)
                        <flux:button wire:click="nextYear" variant="ghost" size="sm" icon-trailing="chevron-right">
                            Next Year
                        </flux:button>
                    @endif
                </div>
            </div>
        </div>
    @elseif (strlen($search) >= 2)
        <!-- Search Results -->
        @if ($this->searchResults->isEmpty())
            <flux:text>No alumni found matching "{{ $search }}".</flux:text>
        @elseif ($this->searchResults->count() === 1)
            <?php $this->selectStudent($this->searchResults->first()->id_students); ?>
        @else
            <div>
                <flux:heading size="lg" class="mb-4">Were you looking for:</flux:heading>
                <div class="space-y-1">
                    @foreach ($this->searchResults as $result)
                        <flux:button
                            wire:click="selectStudent({{ $result->id_students }})"
                            variant="ghost"
                            class="w-full justify-start"
                        >
                            {{ $result->full_name }} ({{ $result->class_of }})
                        </flux:button>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <!-- Year Buttons -->
        <div>
            <flux:heading size="lg" class="mb-4">Browse by Senior Year</flux:heading>
            <div class="flex flex-wrap gap-2">
                @foreach ($this->years as $year)
                    <flux:button
                        wire:click="selectYear({{ $year }})"
                        variant="outline"
                        size="sm"
                    >
                        {{ $year }}
                    </flux:button>
                @endforeach
            </div>
        </div>
    @endif
</div>
