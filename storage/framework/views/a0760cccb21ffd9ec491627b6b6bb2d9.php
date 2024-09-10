<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'currentPageOptionProperty' => 'tableRecordsPerPage',
    'extremeLinks' => false,
    'paginator',
    'pageOptions' => [],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'currentPageOptionProperty' => 'tableRecordsPerPage',
    'extremeLinks' => false,
    'paginator',
    'pageOptions' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    use Illuminate\Contracts\Pagination\CursorPaginator;

    $isRtl = __('filament-panels::layout.direction') === 'rtl';
    $isSimple = ! $paginator instanceof \Illuminate\Pagination\LengthAwarePaginator;
?>

<nav
    aria-label="<?php echo e(__('filament::components/pagination.label')); ?>"
    role="navigation"
    <?php echo e($attributes->class([
            'fi-pagination grid grid-cols-[1fr_auto_1fr] items-center gap-x-3',
            'fi-simple' => $isSimple,
        ])); ?>

>
    <!--[if BLOCK]><![endif]--><?php if(! $paginator->onFirstPage()): ?>
        <?php
            if ($paginator instanceof CursorPaginator) {
                $wireClickAction = "setPage('{$paginator->previousCursor()->encode()}', '{$paginator->getCursorName()}')";
            } else {
                $wireClickAction = "previousPage('{$paginator->getPageName()}')";
            }
        ?>

        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['color' => 'gray','rel' => 'prev','wire:click' => $wireClickAction,'wire:key' => $this->getId() . '.pagination.previous','class' => 'fi-pagination-previous-btn justify-self-start']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','rel' => 'prev','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wireClickAction),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.previous'),'class' => 'fi-pagination-previous-btn justify-self-start']); ?>
            <?php echo e(__('filament::components/pagination.actions.previous.label')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(! $isSimple): ?>
        <span
            class="fi-pagination-overview text-sm font-medium text-gray-700 dark:text-gray-200"
        >
            <?php echo e(trans_choice(
                    'filament::components/pagination.overview',
                    $paginator->total(),
                    [
                        'first' => \Illuminate\Support\Number::format($paginator->firstItem() ?? 0),
                        'last' => \Illuminate\Support\Number::format($paginator->lastItem() ?? 0),
                        'total' => \Illuminate\Support\Number::format($paginator->total()),
                    ],
                )); ?>

        </span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(count($pageOptions) > 1): ?>
        <div class="col-start-2 justify-self-center">
            <label class="fi-pagination-records-per-page-select fi-compact">
                <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                    <?php if (isset($component)) { $__componentOriginal97dc683fe4ff7acce9e296503563dd85 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97dc683fe4ff7acce9e296503563dd85 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.select','data' => ['wire:model.live' => $currentPageOptionProperty]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($currentPageOptionProperty)]); ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($option); ?>">
                                <?php echo e($option === 'all' ? __('filament::components/pagination.fields.records_per_page.options.all') : $option); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97dc683fe4ff7acce9e296503563dd85)): ?>
<?php $attributes = $__attributesOriginal97dc683fe4ff7acce9e296503563dd85; ?>
<?php unset($__attributesOriginal97dc683fe4ff7acce9e296503563dd85); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97dc683fe4ff7acce9e296503563dd85)): ?>
<?php $component = $__componentOriginal97dc683fe4ff7acce9e296503563dd85; ?>
<?php unset($__componentOriginal97dc683fe4ff7acce9e296503563dd85); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $attributes = $__attributesOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__attributesOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $component = $__componentOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__componentOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>

                <span class="sr-only">
                    <?php echo e(__('filament::components/pagination.fields.records_per_page.label')); ?>

                </span>
            </label>

            <label class="fi-pagination-records-per-page-select">
                <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['prefix' => __('filament::components/pagination.fields.records_per_page.label')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament::components/pagination.fields.records_per_page.label'))]); ?>
                    <?php if (isset($component)) { $__componentOriginal97dc683fe4ff7acce9e296503563dd85 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal97dc683fe4ff7acce9e296503563dd85 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.select','data' => ['wire:model.live' => $currentPageOptionProperty]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::input.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model.live' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($currentPageOptionProperty)]); ?>
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $pageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($option); ?>">
                                <?php echo e($option === 'all' ? __('filament::components/pagination.fields.records_per_page.options.all') : $option); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal97dc683fe4ff7acce9e296503563dd85)): ?>
<?php $attributes = $__attributesOriginal97dc683fe4ff7acce9e296503563dd85; ?>
<?php unset($__attributesOriginal97dc683fe4ff7acce9e296503563dd85); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal97dc683fe4ff7acce9e296503563dd85)): ?>
<?php $component = $__componentOriginal97dc683fe4ff7acce9e296503563dd85; ?>
<?php unset($__componentOriginal97dc683fe4ff7acce9e296503563dd85); ?>
<?php endif; ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $attributes = $__attributesOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__attributesOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $component = $__componentOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__componentOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
            </label>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if($paginator->hasMorePages()): ?>
        <?php
            if ($paginator instanceof CursorPaginator) {
                $wireClickAction = "setPage('{$paginator->nextCursor()->encode()}', '{$paginator->getCursorName()}')";
            } else {
                $wireClickAction = "nextPage('{$paginator->getPageName()}')";
            }
        ?>

        <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['color' => 'gray','rel' => 'next','wire:click' => $wireClickAction,'wire:key' => $this->getId() . '.pagination.next','class' => 'fi-pagination-next-btn col-start-3 justify-self-end']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => 'gray','rel' => 'next','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wireClickAction),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.next'),'class' => 'fi-pagination-next-btn col-start-3 justify-self-end']); ?>
            <?php echo e(__('filament::components/pagination.actions.next.label')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if((! $isSimple) && $paginator->hasPages()): ?>
        <ol
            class="fi-pagination-items justify-self-end rounded-lg bg-white shadow-sm ring-1 ring-gray-950/10 dark:bg-white/5 dark:ring-white/20"
        >
            <!--[if BLOCK]><![endif]--><?php if(! $paginator->onFirstPage()): ?>
                <!--[if BLOCK]><![endif]--><?php if($extremeLinks): ?>
                    <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['ariaLabel' => __('filament::components/pagination.actions.first.label'),'icon' => $isRtl ? 'heroicon-m-chevron-double-right' : 'heroicon-m-chevron-double-left','iconAlias' => $isRtl ? 'pagination.first-button.rtl' : 'pagination.first-button','rel' => 'first','wire:click' => 'gotoPage(1, \'' . $paginator->getPageName() . '\')','wire:key' => $this->getId() . '.pagination.first']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament::components/pagination.actions.first.label')),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'heroicon-m-chevron-double-right' : 'heroicon-m-chevron-double-left'),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'pagination.first-button.rtl' : 'pagination.first-button'),'rel' => 'first','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('gotoPage(1, \'' . $paginator->getPageName() . '\')'),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.first')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['ariaLabel' => __('filament::components/pagination.actions.previous.label'),'icon' => $isRtl ? 'heroicon-m-chevron-right' : 'heroicon-m-chevron-left','iconAlias' => $isRtl ? ['pagination.previous-button.rtl', 'pagination.previous-button'] : 'pagination.previous-button','rel' => 'prev','wire:click' => 'previousPage(\'' . $paginator->getPageName() . '\')','wire:key' => $this->getId() . '.pagination.previous']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament::components/pagination.actions.previous.label')),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'heroicon-m-chevron-right' : 'heroicon-m-chevron-left'),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? ['pagination.previous-button.rtl', 'pagination.previous-button'] : 'pagination.previous-button'),'rel' => 'prev','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('previousPage(\'' . $paginator->getPageName() . '\')'),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.previous')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $paginator->render()->offsetGet('elements'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!--[if BLOCK]><![endif]--><?php if(is_string($element)): ?>
                    <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['disabled' => true,'label' => $element]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => true,'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($element)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <!--[if BLOCK]><![endif]--><?php if(is_array($element)): ?>
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['active' => $page === $paginator->currentPage(),'ariaLabel' => trans_choice('filament::components/pagination.actions.go_to_page.label', $page, ['page' => $page]),'label' => $page,'wire:click' => 'gotoPage(' . $page . ', \'' . $paginator->getPageName() . '\')','wire:key' => $this->getId() . '.pagination.' . $paginator->getPageName() . '.' . $page]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page === $paginator->currentPage()),'aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(trans_choice('filament::components/pagination.actions.go_to_page.label', $page, ['page' => $page])),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($page),'wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('gotoPage(' . $page . ', \'' . $paginator->getPageName() . '\')'),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.' . $paginator->getPageName() . '.' . $page)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

            <!--[if BLOCK]><![endif]--><?php if($paginator->hasMorePages()): ?>
                <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['ariaLabel' => __('filament::components/pagination.actions.next.label'),'icon' => $isRtl ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right','iconAlias' => $isRtl ? ['pagination.next-button.rtl', 'pagination.next-button'] : 'pagination.next-button','rel' => 'next','wire:click' => 'nextPage(\'' . $paginator->getPageName() . '\')','wire:key' => $this->getId() . '.pagination.next']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament::components/pagination.actions.next.label')),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'heroicon-m-chevron-left' : 'heroicon-m-chevron-right'),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? ['pagination.next-button.rtl', 'pagination.next-button'] : 'pagination.next-button'),'rel' => 'next','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('nextPage(\'' . $paginator->getPageName() . '\')'),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.next')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>

                <!--[if BLOCK]><![endif]--><?php if($extremeLinks): ?>
                    <?php if (isset($component)) { $__componentOriginalec17467508bb249fe632a72f94ddd47a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalec17467508bb249fe632a72f94ddd47a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.pagination.item','data' => ['ariaLabel' => __('filament::components/pagination.actions.last.label'),'icon' => $isRtl ? 'heroicon-m-chevron-double-left' : 'heroicon-m-chevron-double-right','iconAlias' => $isRtl ? 'pagination.last-button.rtl' : 'pagination.last-button','rel' => 'last','wire:click' => 'gotoPage(' . $paginator->lastPage() . ', \'' . $paginator->getPageName() . '\')','wire:key' => $this->getId() . '.pagination.last']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::pagination.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('filament::components/pagination.actions.last.label')),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'heroicon-m-chevron-double-left' : 'heroicon-m-chevron-double-right'),'icon-alias' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isRtl ? 'pagination.last-button.rtl' : 'pagination.last-button'),'rel' => 'last','wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('gotoPage(' . $paginator->lastPage() . ', \'' . $paginator->getPageName() . '\')'),'wire:key' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->getId() . '.pagination.last')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $attributes = $__attributesOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__attributesOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalec17467508bb249fe632a72f94ddd47a)): ?>
<?php $component = $__componentOriginalec17467508bb249fe632a72f94ddd47a; ?>
<?php unset($__componentOriginalec17467508bb249fe632a72f94ddd47a); ?>
<?php endif; ?>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </ol>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</nav>
<?php /**PATH C:\laragon\www\app-project-management\vendor\filament\support\src\/../resources/views/components/pagination/index.blade.php ENDPATH**/ ?>