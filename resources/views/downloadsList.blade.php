<div>
    <table>
        <thead>
            <tr>
                <th>
                    URL
                </th>
                <th>
                    Status
                </th>
                <th>
                    Download link
                </th>
            </tr>
        </thead>
        <tbody>
            @each('downloadItem', $downloads, 'download', 'downloadsEmpty')
        </tbody>
    </table>
</div>