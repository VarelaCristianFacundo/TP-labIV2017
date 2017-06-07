import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AltaPedidoComponent } from './alta-pedido.component';

describe('AltaPedidoComponent', () => {
  let component: AltaPedidoComponent;
  let fixture: ComponentFixture<AltaPedidoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AltaPedidoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AltaPedidoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
