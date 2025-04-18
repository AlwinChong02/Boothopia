<div style="padding: 25px; width: 100%;"> 
    {{-- Title --}}
    @if($title)
        <h2 class="mb-4 pt-2 fw-bold">{{ $title }}</h2>
    @endif

    {{-- Per Page Selector --}}
    @if($route)
        <form method="GET" action="{{ $route }}" class="mb-3 d-flex align-items-center">
            <label for="perPage" class="me-2">Show:</label>
            <select name="perPage" id="perPage" onchange="this.form.submit()" class="form-select w-auto">
                @foreach($perPageOptions as $size)
                    <option value="{{ $size }}" {{ request('perPage') == $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>
            <span class="ms-2">items per page</span>
        </form>
    @endif

    {{-- Table --}}
    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($paginator)
        <div class="pagination-wrapper mt-4">
            {{ $paginator->appends(['perPage' => request('perPage')])->links() }}
        </div>
    @endif
</div>

{{-- Table & Pagination Styles --}}
<style>
    .w-5 { display: none }

    h2 {
        color: #333;
    }

    .table-container {
        max-height: 550px;
        overflow-y: auto;
        border: 1px solid #eee;
        border-radius: 10px;
        display: block;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table thead th {
        position: sticky;
        top: 0;
        background-color: #0096C7;
        color: white;
        padding: 14px 20px;
        z-index: 1;
    }

    .custom-table th,
    .custom-table td {
        padding: 14px 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .custom-table tr:hover {
        background-color: #f1f1f1;
    }

    .custom-table td {
        font-size: 14px;
        color: #333;
        word-wrap: break-word;
        white-space: normal;
    }

    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) {
        width: 58px;
    }

    .pagination-wrapper nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 14px;
    }

    .pagination-wrapper nav .flex {
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .pagination-wrapper nav .flex a,
    .pagination-wrapper nav .flex span {
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        margin: 0 2px;
        transition: 0.2s ease;
        min-width: 36px;
        text-align: center;
        color: #007bff;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
    }

    .pagination-wrapper nav .flex a:hover {
        background-color: #e2e6ea;
    }

    .pagination-wrapper nav .flex span[aria-current="page"] {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border-color: #007bff;
    }
</style>
