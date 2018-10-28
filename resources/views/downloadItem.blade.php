<tr>
    <td>
        {{ $download->url }}
    </td>
    <td>
        <p class={{ strtolower($download->getStatusName())  }}>
            {{ $download->getStatusName() }}
        </p>
    </td>
    <td>
        @unless ($download->isReady())
            ...
        @else
            <a href="/get/{{ $download->id }}" target="_blank">{{ $download->url }}</a>
        @endunless
    </td>
</tr>
