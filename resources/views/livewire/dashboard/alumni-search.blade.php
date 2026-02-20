<div>
    <!-- Alumni Count -->
    <div class="mb-6">
        <flux:heading size="lg">Alumni Directory</flux:heading>
        <flux:subheading>{{ number_format($this->alumniCount) }} alumni in the directory</flux:subheading>
    </div>

    <!-- Search Input -->
    <div class="mb-6 max-w-md">
        <flux:input
            wire:model.live.debounce.300ms="search"
            placeholder="Search by name..."
            icon="magnifying-glass"
            clearable
        />
    </div>

    @if ($selectedStudentId && $this->selectedStudent)
        <!-- Class List Display -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <flux:heading size="lg">
                    Class of {{ $this->selectedStudent->class_of }}
                </flux:heading>
                <flux:button wire:click="clearSelection" variant="ghost" size="sm">
                    Back to Search
                </flux:button>
            </div>

            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Name</flux:table.column>
                    <flux:table.column>Senior Year</flux:table.column>
                </flux:table.columns>
                <flux:table.rows>
                    @foreach ($this->classList as $classmate)
                        <flux:table.row :class="$classmate->id_students === $selectedStudentId ? 'bg-blue-50 dark:bg-blue-900/20' : ''">
                            <flux:table.cell>{{ $classmate->full_name }}</flux:table.cell>
                            <flux:table.cell>{{ $classmate->class_of }}</flux:table.cell>
                        </flux:table.row>
                    @endforeach
                </flux:table.rows>
            </flux:table>
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
    @endif
</div>
