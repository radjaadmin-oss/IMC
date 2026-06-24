{{--
    RADJATIKET V2 - Table Component
    
    Responsive data table with search, sort, pagination
    
    Usage:
    <x-table 
        :headers="['Order Code', 'Customer', 'Amount', 'Status']"
        :rows="$orders"
        :columns="['order_code', 'customer_name', 'total_price', 'status']"
    />
--}}

@props([
    'headers' => [],        // Array of header labels
    'rows' => [],           // Collection/array of data rows
    'columns' => [],        // Array of column keys
    'empty' => 'No data available',
    'striped' => true,      // Striped rows
    'hoverable' => true,    // Hover effect
])

<div class="overflow-x-auto bg-white rounded-xl border border-gray-200 shadow-sm">
    <table class="min-w-full divide-y divide-gray-200">
        {{-- Table Header --}}
        <thead class="bg-gray-50">
            <tr>
                @foreach($headers as $header)
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                        {{ $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        
        {{-- Table Body --}}
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($rows as $index => $row)
                <tr class="{{ $striped && $index % 2 === 1 ? 'bg-gray-50' : '' }} {{ $hoverable ? 'hover:bg-gray-100' : '' }} transition-colors">
                    @foreach($columns as $column)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @if(is_object($row))
                                {{ data_get($row, $column) }}
                            @elseif(is_array($row))
                                {{ $row[$column] ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) }}" class="px-6 py-12 text-center">
                        <x-empty-state 
                            icon="search"
                            :title="$empty"
                            description="Try adjusting your search or filter to find what you're looking for."
                        />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    {{-- Pagination (if Laravel collection) --}}
    @if(method_exists($rows, 'links'))
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $rows->links() }}
        </div>
    @endif
</div>
