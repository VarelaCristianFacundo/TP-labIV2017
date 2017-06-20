import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltapedidosComponent } from './altapedidos.component';

describe('AltapedidosComponent', () => {
  let component: AltapedidosComponent;
  let fixture: ComponentFixture<AltapedidosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltapedidosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltapedidosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
