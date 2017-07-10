@push('scripts')
<script src="/js/activities.js"></script>
@endpush

{!!
$repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* false: load all children, true: only direct */
            [
                'decorate' => true,
                'html' => true,
                'rootOpen' => '<ul>',
                'rootClose' => '</ul>',
                'childOpen' => '',
                'childClose' => '',
                'nodeDecorator' => function($node) {
                    $en = $node['names']['values']['en'];
                    $ru = $node['names']['values']['ru'];
                    $code = $node['internalCode'];
                    $nodeId = $node['_id']->bin;

                    $route = route('economicalActivityTypes.edit', [$nodeId]);
                    $edit = "<a href=\"$route\" class='btn btn-default btn-xs'><i class=\"glyphicon glyphicon-edit\" ></i></a>";

                    $result = Form::open(['route' => ['economicalActivityTypes.destroy', $nodeId], 'method' => 'delete']);
                    $delete = Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'onclick' => "return confirm('Are you sure?')"
                                                    ]);

                    $title = "<a class=\"tree_node text-primary\" id=\"$nodeId\" href=#>$code: $en / $ru</a>";

                    if (empty($node['__children'])) {
                        $title = "<span class=\"text-muted\">$code: $en / $ru</span>";
                    }

                    if ($node['level'] > 1) {
                        $parentId = $node['parent']['$id']->bin;
                        $result .= "<li class=\"hide child$parentId\" id=\"$nodeId\">$title $edit $delete</li>";
                    } else {
                        $result .= "<li>$title $edit $delete</li>";
                    }

                    $result .= Form::close();

                    return $result;
                }
            ]
        ) !!}
